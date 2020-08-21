<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <h1>Albums</h1>
      </div>
      <div class="col-md-8">
        <button class="btn btn-primary float-right mb-3" @click="showAddModal">
          <font-awesome-icon icon="edit" />&nbsp;Add
        </button>
      </div>
    </div>

    <div class="card card-body mb-3" style="height:165px" v-for="album in albums" :key="album.id">
      <div class="row h-100">
        <div class="col-sm-4 col-lg-2 h-100">
          <img
            :src="album.coverImgLink"
            class="w-100 rounded cover-img h-100"
            style="object-fit:cover"
          />
        </div>
        <div class="col-sm-8 col-lg-10 h-100">
          <div class="card-title align-middle">
            <h2>
              <a :href="'/albums/' + album.id">{{ album.title }}</a>
            </h2>
            <small>{{ album.pictures_count }} pictures</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Gallery",
  methods: {
    ...mapActions(["fetchAlbums", "storeAlbum"]),
    async showAddModal() {
      let { value: album } = await this.$swal({
        html:
          '<div class="form-group">' +
          '<input id="swal-input1" class="form-control" placeholder="Title">' +
          "</div>" +
          "<div>" +
          '<input id="swal-input2" class="form-control" placeholder="Cover image link">' +
          "</div>",
        focusConfirm: false,
        allowOutsideClick: false,
        showCancelButton: true,
        preConfirm: () => {
          return {
            title: document.getElementById("swal-input1").value,
            coverImgLink: document.getElementById("swal-input2").value,
          };
        },
      });

      if (album) {
        this.storeAlbum(album);
      }
    },
  },
  computed: mapGetters({
    albums: "getAllAlbums",
  }),
  created() {
    this.fetchAlbums();
  },
};
</script>