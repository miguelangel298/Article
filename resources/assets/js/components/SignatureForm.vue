<template>
    <div>
        <div class="alert alert-success" v-if="saved">
            <strong>Guarded!</strong> Your article is published.
        </div>

        <div class="well well-sm" id="signature-form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Publish Article</legend>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9" :class="{'has-error': errors.name}">
                            <input id="name"
                                   v-model="signature.name"
                                   type="text"
                                   placeholder="Full name"
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
                                   placeholder="Email"
                                   class="form-control">
                            <span v-if="errors.email" class="help-block text-danger">{{ errors.email[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="body">Message</label>
                        <div class="col-md-9" :class="{'has-error': errors.body}">
                                    <textarea class="form-control"
                                              id="body"
                                              v-model="signature.body"
                                              placeholder="Please write your article ..."
                                              rows="5"></textarea>
                            <span v-if="errors.body" class="help-block text-danger">{{ errors.body[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
