<template>
  <div class="row">
    <div class="border">
      <vue-web-cam
        ref="webcam"
        :device-id="deviceId"
        class="img-fluid img-thumbnail"
        style="display: none;"
        @error="onError"
        @cameras="onCameras"
      />
      <figure class="figure">
         <!--  <img :src="img" ref="faceframe" class="img-fluid" id="faceframe"> -->
          <canvas ref="canvas" id="canvas" class="img-fluid">
            Your browser does not support the HTML5 canvas tag.
            </canvas>
        </figure>
    </div>
  </div>

</template>

<script>
import { WebCam } from "vue-web-cam";

export default {

  data: function() {
    return {
        img: null,
        camera: null,
        deviceId: null,
        devices: [],
        recursos: []
    };
  },
  computed: {
    device: function() {
      return this.devices.find(n => n.deviceId === this.deviceId);
    }
  },
  watch: {
    camera: function(id) {
      this.deviceId = id;
    },
    devices: function() {
      // Once we have a list select the first one
      const [first, ...tail] = this.devices;
      if (first) {
        this.camera = first.deviceId;
        this.deviceId = first.deviceId;
      }
    }
  },
  methods: {
    validar() {

        this.img = this.$refs.webcam.capture();

        let formData = new FormData();

        formData.append('image64', this.img);
        formData.append('csrfmiddlewaretoken', '{{ csrf_token }}');
        axios.post("http://127.0.0.1:8000/apicall", formData, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
            this.recursos = res.data;
            this.draw(this.img);

        }).catch(err => {
            console.log(err);
        });
    },

    onCapture() {
      this.img = this.$refs.webcam.capture();
    },
    onStart() {
      this.$refs.webcam.start();
    },
    onError(error) {
      console.log("On Error Event", error);
    },
    onCameras(cameras) {
      this.devices = cameras;
      console.log("On Cameras Event", cameras);
    },

    draw(imgscr) {

        var ctx = document.getElementById('canvas').getContext('2d');

        var img = new Image();

        if  (null != this.recursos.faces[0]){

            var x1 = this.recursos.faces[0].face_rectangle.left;
            var y1 = this.recursos.faces[0].face_rectangle.top;
            var x2 = this.recursos.faces[0].face_rectangle.width;
            var y2 = this.recursos.faces[0].face_rectangle.height;

            img.onload = function() {
                canvas.width = img.naturalWidth
                canvas.height = img.naturalHeight
                ctx.strokeStyle = "#FF0000";
                ctx.lineWidth = 5;
                ctx.drawImage(img,0,0);
                ctx.strokeRect(x1, y1, x2, y2);
            };
        }else {
            img.onload = function() {
                canvas.width = img.naturalWidth
                canvas.height = img.naturalHeight
                ctx.font = '24px serif';
                ctx.drawImage(img,0,0);
                ctx.fillText('No detectado', 50, 50);
             };
        };

        img.src = imgscr;
    }
  },

  created: function() {
    this.interval = setInterval(
      function() {
        this.validar();
      }.bind(this),
      5000
    );
  },
  beforeDestroy() {
    clearInterval(this.recursos);
  }
};
</script>
