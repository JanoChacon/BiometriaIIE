<template>

<div>
<!-- Modal webcam -->
    <div class="modal fade" id="nowebcamModal" tabindex="-1" role="dialog" aria-labelledby="nowebcamModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="webcamModal">Conexión con cámara</h5>
                </div>
                <div class="modal-body">
                    <p>No hay comunicación con la cámara del dispositivo, por favor revise los permisos.</p>
                    <p><strong>Active la cámara y reingrese al cuestionario.</strong></p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:location.reload(true)">Recargar la página</a>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Conexion -->
    <div class="modal fade" id="noconexionModal" tabindex="-1" role="dialog" aria-labelledby="noconexionModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noconexionModal">Conexión con cámara</h5>
                </div>
                <div class="modal-body">
                    <p>No hay comunicación con el servidor.</p>
                    <p><strong>Por favor revise su conexión a internet y reingrese al cuestionario.</strong></p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:location.reload(true)">Recargar la página</a>
                </div>
            </div>
        </div>
    </div>

<!-- Modal sesion -->
    <div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="validateModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="validateModallLabel">Validar sesión</h5>
                </div>
                <div class="modal-body">
                    <p>Por motivos de seguridad, valide su sesión nuevamente</p>

                    <div class="alert alert-danger" style="display: none" id="incorrectdata-alert">
                        <strong>Datos inválidos o rostro no detectado,</strong> Intente nuevamente.
                    </div>

                    <form method="POST" @submit.prevent="validarSesion">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" v-model="email" type="email" class="form-control" name="email" value="email" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" v-model="password" type="password" class="form-control" name="password" min="8" required autocomplete="current-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Foto actual</label>
                            <figure class="figure col-md-6">
                                <img :src="img" ref="faceframe" class="img-fluid mx-auto" id="faceframe">
                            </figure>
                        </div>


                        <div class="modal-footer">
                            <a class="btn btn-danger" href="home">Salir del cuestionario</a>
                            <button type="submit" class="btn btn-primary">
                                    Validar Sesión
                             </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal inicio -->
    <div class="modal fade" id="inicioModal" tabindex="-1" role="dialog" aria-labelledby="inicioModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inicioModalLabel">Instrucciones</h5>
                </div>

                    <div id="carouselContent" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="false">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active text-left p4">
                                <div class="modal-body">
                                    <div class="container">
                                        <li class="col-sm-11">Este cuestionario funciona a través de la detección de su rostro registrado,
                                            por lo cual necesita acceso a la cámara web de su computadora.</li><br>
                                        <li class="col-sm-11">Asegúrese de permitir el uso de la cámara en esta página a través del navegador web. </li><br>
                                        <li class="col-sm-11">Lo registrado por la cámara no se guardará en ningún caso, la detección se hace en tiempo real. </li><br>
                                        <li class="col-sm-11">Una vez se asegure de tener la cámara configurada, presione en el botón <strong>siguiente</strong>. </li><br>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a class="btn btn-info" href="#carouselContent" role="button" data-slide="next">
                                        Siguiente</a>
                                </div>
                            </div>
                            <div class="carousel-item text-left p4">
                                <div class="modal-body">
                                    <div class="container">
                                        <li class="col-sm-11">El sistema detectará el número de rostros en pantalla,
                                            si detecta más de uno pedirá validar su sesión hasta que detecte solo un rostro nuevamente.</li><br>
                                        <li class="col-sm-11">En caso de que su rostro no se encuentre en el campo de visión de la cámara o no se encuentre detectable,
                                            el sistema pedirá validar sesión igualmente.</li><br>
                                        <li class="col-sm-11">Asegúrese de tener el rostro lo más claro posible, no cubra su rostro con las manos o objetos similares,
                                             los lentes claros no darán problemas de autenticación.</li><br>
                                        <li class="col-sm-11">Asegúrese de tener buena iluminación en el lugar donde realizará el cuestionario.</li><br>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="#carouselContent" role="button" data-slide="prev">
                                        Atras</a>
                                    <a class="btn btn-info" href="#carouselContent" role="button" data-slide="next">
                                        Siguiente</a>
                                </div>
                            </div>
                            <div class="carousel-item text-left p4">
                                <div class="modal-body">
                                    <div class="container">
                                        <li class="col-sm-11">Asegúrese que su rostro se encuentra en imagen mostrada a continuación.</li><br>
                                        <li class="col-sm-11">Si no se muestra ninguna imagen, asegúrese de revisar lo mencionado anteriormente.</li><br>
                                        <li class="col-sm-11">Una vez su rostro se encuentre en la imagen a continuación, presione el botón comenzar para ir al cuestionario</li><br>
                                        <label class="col-md-4 col-form-label text-md-right">Captura actual</label>
                                        <figure class="figure col-md-6">
                                            <img :src="img" class="img-fluid mx-auto">
                                        </figure>
                                        <div class="alert alert-danger" style="display: none" id="incorrectdataInicio-alert">
                                            <strong>rostro no detectado aún,</strong> Intente nuevamente.
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="#carouselContent" role="button" data-slide="prev">
                                        Atras</a>
                                    <a class="btn btn-success" href="#carouselContent" role="button" v-on:click="beginTest()">
                                        Comenzar</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

  <div class="row">
    <div class="border">
      <vue-web-cam
        ref="webcam"
        :device-id="deviceId"
        class="img-fluid"
        @error="onError"
        @cameras="onCameras"
      />
    </div>
  </div>
</div>
</template>

<script>
import { WebCam } from "vue-web-cam";

export default {
    props: ['refreshData'],

  data: function() {
    return {
        img: null,
        camera: null,
        deviceId: null,
        devices: [],
        recursos: [],
        email: null,
        password: null,
        conf: 78,
        facelength: 1,
        begin: false,
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

    validarRostro() {

        if (this.img != this.$refs.webcam.capture() && this.deviceId != null) {

            this.img = this.$refs.webcam.capture();

            console.log( "device: " + this.deviceId);

            let formData = new FormData();

            formData.append('image64', this.img);
            formData.append('csrfmiddlewaretoken', '{{ csrf_token }}');

            axios.post("http://127.0.0.1:8000/api-compare",  formData, {
                    headers: {
                    'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {

                this.recursos = res.data;

                console.log("confidence api: " + this.recursos.confidence);
                console.log("promedio: "+ this.conf);

                this.facelength = this.recursos.faces2.length;

                if (typeof(this.recursos.confidence) != 'undefined' && this.recursos.confidence != null) {
                    this.conf = (this.conf+this.recursos.confidence)/2;
                }else{
                    this.conf = this.conf/2;
                }

                if (this.conf <= 70 || this.facelength != 1) {
                    if (this.begin) {
                        $('#validateModal').modal('show');
                    }
                }

            }).catch(err => {
                console.log(err);
            });
        } else if (this.begin) {
            $('#nowebcamModal').modal('show');
        }
    },

    beginTest(){
        if (this.deviceId != null && this.img != this.$refs.webcam.capture()) {
            if (this.recursos.confidence >= 78 && this.recursos.faces2.length ==1) {
                this.begin = true;
                $('#inicioModal').modal('hide');
                $('#incorrectdataInicio-alert').modal('hide');
            } else {
                $('#incorrectdataInicio-alert').modal('show');

            }

        }
    },

    validarSesion(){

        console.log("confidence api para sesion: " + this.recursos.confidence);
        console.log("promedio para sesion: "+ this.conf);
        console.log( "device para sesion : " + this.deviceId);

        if (this.recursos.confidence > 78 && this.facelength ==1) {

            let formData = new FormData();

            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('csrfmiddlewaretoken', '{{ csrf_token }}');

            axios.post("http://127.0.0.1:8000/session-validate", formData, {
                    headers: {
                    'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {

                if (res.data == true) {
                    $('#incorrectdata-alert').modal('hide');
                    $('#validateModal').modal('hide');
                }else{
                    $('#incorrectdata-alert').modal('show');
                }
            }).catch(err => {
                console.log(err);
            });
        } else{
            $('#incorrectdata-alert').modal('show');
        }
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
  },

  created: function() {
      this.interval = setInterval(
        function() {
            this.validarRostro();
            }
        .bind(this),5000);
  },

  mounted: function() {
    $('#inicioModal').modal('show');
  },
beforeDestroy() {
    clearInterval(this.recursos);
  }
};
</script>
