<template>
    <div>
        <div class="alert alert-success" v-if="saved">
            <strong>Guardado!</strong> Tu Articulo esta publicado.
        </div>

        <div class="well well-sm" id="signature-form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Publicar Articulo</legend>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Nombre</label>
                        <div class="col-md-9" :class="{'has-error': errors.name}">
                            <input id="name"
                                   v-model="signature.name"
                                   type="text"
                                   placeholder="Nombre completo"
                                   class="form-control">
                            <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>
                        <div class="col-md-9" :class="{'has-error': errors.email}">
                            <input id="email"
                                   v-model="signature.email"
                                   type="text"
                                   placeholder="Correo electronico"
                                   class="form-control">
                            <span v-if="errors.email" class="help-block text-danger">{{ errors.email[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="body">Mensaje</label>
                        <div class="col-md-9" :class="{'has-error': errors.body}">
                                    <textarea class="form-control"
                                              id="body"
                                              v-model="signature.body"
                                              placeholder="Por favor escriba su articulo..."
                                              rows="5"></textarea>
                            <span v-if="errors.body" class="help-block text-danger">{{ errors.body[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      saved: false,
      signature: {
        name: null,
        email: null,
        body: null,
      }
    };
  },
  methods: {
    onSubmit() {
      this.saved = false;
      axios.post('api/signatures', this.signature)
      .then(({ data }) => this.setSuccessMessage())
      .catch(({ response }) => this.setErrors ( response ));
    },
    setErrors ( response ) {
      this.errors = response.data.errors;
    },
    edit: function () {
    EventBus.$emit('editing');
    },
    setSuccessMessage () {
      this.reset();
      this.saved = true;
      this.edit();
    },
    reset() {
      this.errors = [];
      this.signature = { name: null, email: null,  body: null };
    }
  }
}
</script>
