<template >
  <div >
    <div class="row">
      <div class="col-md-4 " v-for="signature in signatures">
        <div class="card "  >
          <div class="card-img" style="background-image:url(https://media.istockphoto.com/vectors/vector-isolated-vintage-typewriter-retro-equipment-flat-style-vector-id913384232?k=6&m=913384232&s=612x612&w=0&h=BXZex83JD5c2zdaBvkrGpeRtWuNt2ARhVdVMDndX0F0=);">
            <div class="overlay">
              <div class="overlay-content">
                <a class="hover" href="#!">Detail</a>
              </div>
            </div>
          </div>
          <div class="card-content">
            <a href="#!">
              <h2> By: {{ signature.name }}</h2>
              <p>{{ signature.body }}</p>
            </a>
          </div>
        </div>
      </div>
    </div>
    <paginate
            :page-count="pageCount"
            :click-handler="fetch"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'">
    </paginate>
  </div>
</template>

<script>
export default {

  data () {
    return {
      signatures: [],
      pageCount: 1,
      endpoint: 'api/signatures?page='
    };
  },
  mounted: function () {
    this.fetch();
    EventBus.$on('editing', function (index) {
      this.fetch();
    }.bind(this));
  },
  methods: {
    fetch(page = 1) {
      axios.get(this.endpoint + page)
          .then(({data}) => {
            this.signatures = data.data;
            this.pageCount = data.meta.last_page;
          });
    },
    report(id) {
      if(confirm('Afirmacion')) {
        axios.put('api/signatures/'+id+'/report')
        .then(response => this.removeSignature(id));
      }
    },
    removeSignature(id) {
          this.signatures = _.remove(this.signatures, function (signature) {
              return signature.id !== id;
          });
      }
  }
}
</script>
