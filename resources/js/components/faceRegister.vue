<template>
    <div>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#webcamModal">
            Capturar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="webcamModal" tabindex="-1" role="dialog" aria-labelledby="webcamModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="webcamModalLabel">Rostro</h5>
                    </div>
                    <div class="modal-body">
                        <div id="loading-gif" style="display: none">
                            <img class="mx-auto d-block" src="./assets/img/loading.gif">
                        </div>
                        <figure class="figure" id="webcam-fig">
                            <vue-web-cam
                                ref="webcam"
                                :device-id="deviceId"
                                class="img-fluid img-thumbnail"
                                @error="onError"
                                @cameras="onCameras"
                            />
                        </figure>
                        <div class="alert alert-danger" style="display: none" id="noface-alert">
                            <strong>Rostro no detectado! (¿Mala iluminación?)</strong> Intente nuevamente.
                        </div>
                        <figure id="canvas-div" style="display: none">
                            <canvas ref="canvas" id="canvas" class="img-fluid img-thumbnail">
                                Your browser does not support the HTML5 canvas tag.
                            </canvas>
                            <button type="button" class="btn btn-success" v-on:click="enviarFoto()">Guardar rostro</button>
                            <button type="button" class="btn btn-warning" v-on:click="validar()">Otro rostro</button>
                        </figure>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" v-on:click="validar()">Capturar rostro</button>
                    </div>
                </div>
            </div>
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
        recursos: [],
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
        $('#noface-alert').hide();
        $('#webcam-fig').hide();
        $('#loading-gif').show();
        $('#canvas-div').hide();

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
            this.guardarFoto();

        }).catch(err => {
            console.log(err);
        });
    },

    onCapture() {
      this.img = this.$refs.webcam.capture();
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
            var quality = this.recursos.faces[0].attributes.facequality.value;

            img.onload = function() {
                canvas.width = img.naturalWidth
                canvas.height = img.naturalHeight
                ctx.strokeStyle = "#FF0000";
                ctx.font = '32px Helvetica';
                ctx.fillStyle = "red";
                ctx.lineWidth = 5;
                ctx.drawImage(img,0,0);
                ctx.fillText(quality, 50, 50);
                ctx.strokeRect(x1, y1, x2, y2);
            };
        };

        img.src = imgscr;
    },
    enviarFoto(){
        console.log(this.recursos.faces[0].face_token);
        console.log(this.img);
        $('#webcamModal').modal('toggle');
        $('#image').val(this.recursos.faces[0].face_token);
    },
    guardarFoto(){

        var quality = this.recursos.faces[0].attributes.facequality.value;
        console.log(quality);

        if (quality >= 85.1) {
            this.draw(this.img);
            $('#loading-gif').hide();
            $('#canvas-div').show();
        }else{
            $('#webcam-fig').show();
            $('#loading-gif').hide();
            $('#noface-alert').show();

        }

    }
  }
};
</script>
