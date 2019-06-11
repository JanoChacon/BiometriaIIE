<template>
  <div class="row">

    <div class="border">
      <vue-web-cam
        ref="webcam"
        :device-id="deviceId"
        class="img-fluid img-thumbnail"
        @error="onError"
        @cameras="onCameras"
      />
    </div>

    <div class="border">
        <figure class="figure">
          <img :src="img" class="img-fluid img-thumbnail">
        </figure>
    </div>

    <div class="container" v-for="recurso in recursos">
      <h5>{{ recurso.mensaje }}</h5>
      <p>peticion.</p>
    </div>
  </div>

</template>

<script>
import { WebCam } from "vue-web-cam";
export default {
    components: {
    "vue-web-cam": WebCam
  },
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
        let formData = new FormData();
        this.img = this.$refs.webcam.capture();
        formData.append('image64', this.img);
        axios.post("http://127.0.0.1:8000/apicall", formData, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
            this.recursos = res.data;

            console.log(this.recursos);
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
    }
  },

  created: function() {
    this.interval = setInterval(
      function() {
        this.validar();
      }.bind(this),
      10000
    );
  },
  beforeDestroy() {
    clearInterval(this.recursos);
  }
};
</script>
