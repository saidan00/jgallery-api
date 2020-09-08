<template>
  <div>
    <a class="btn btn-primary mb-3" href="/">
      <font-awesome-icon icon="backward" />&nbsp;Go back
    </a>

    <button class="btn btn-danger mb-3 float-right" @click="deleteAlbum">
      <font-awesome-icon icon="trash" />&nbsp;Delete
    </button>

    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <img class="mr-3 rounded" :src="album.coverImgLink" />
          <div class="lh-100">
            <h2 id="album-title" data-field="title">
              {{album.title}}
              <button
                @click="showAlbumEditModal"
                class="btn btn-light btn-sm"
                title="Edit"
              >
                <font-awesome-icon icon="edit" />
              </button>
            </h2>

            <small>{{album.pictures_count}} pictures</small>
          </div>
        </div>
      </div>

      <div class="card-header">
        <div class="row">
          <div class="col-4">
            <input id="picture-title" type="text" class="form-control" placeholder="Title" />
          </div>
          <div class="col-7">
            <input id="picture-imgLink" type="text" class="form-control" placeholder="Image link" />
          </div>
          <div class="col-1">
            <input
              type="button"
              class="btn btn-success w-100 font-weight-bold"
              title="Add"
              value="Add"
              @click="addPicture"
            />
          </div>
        </div>
      </div>

      <div class="card-body table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Image</th>
              <th scope="col">Title</th>
              <th scope="col">Image Link</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <draggable v-model="album.pictures" tag="tbody" animation="200" @end="updateOrder">
            <tr
              v-for="(picture, indexKey) in album.pictures"
              :key="picture.id"
              :class="{'faded-in' : !isLoading && picture.id === updatedPictureId}"
            >
              <th scope="row" class="align-middle">{{indexKey + 1}}</th>
              <td class="align-middle content">
                <img :src="picture.imgLink" class="rounded" />
              </td>
              <td class="align-middle content" :id="'picture-title-' + picture.id">{{picture.title}}</td>
              <td
                class="align-middle content"
                :id="'picture-imgLink-' + picture.id"
              >{{picture.imgLink}}</td>
              <td class="align-middle content">
                <button
                  class="btn btn-primary w-100"
                  title="Edit"
                  @click="showEditModal(picture.id)"
                >
                  <font-awesome-icon icon="edit" />
                </button>
              </td>
              <td class="align-middle content">
                <button
                  class="btn btn-danger w-100"
                  title="Delete"
                  @click="deletePicture(picture.id)"
                >
                  <font-awesome-icon icon="trash" />
                </button>
              </td>
            </tr>
          </draggable>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import draggable from "vuedraggable";
import { toast } from "../helpers";

export default {
  name: "Album",
  components: {
    draggable,
  },
  data: function () {
    return {
      updatedPictureId: -1,
    };
  },
  props: ["id"],
  methods: {
    ...mapActions([
      "fetchAlbum",
      "updateAlbum",
      "destroyAlbum",
      "storePicture",
      "updatePicture",
      "updateOrderNumber",
      "destroyPicture",
      "startLoading",
      "doneLoading",
    ]),
    async showEditModal(pictureId) {
      let title = document.getElementById("picture-title-" + pictureId)
        .innerHTML;
      let imgLink = document.getElementById("picture-imgLink-" + pictureId)
        .innerHTML;

      let { value: picture } = await this.$swal({
        html:
          '<div class="form-group">' +
          '<input id="swal-input1" class="form-control" placeholder="Title" value="' +
          title +
          '">' +
          "</div>" +
          '<div class="">' +
          '<input id="swal-input2" class="form-control" placeholder="Image link" value="' +
          imgLink +
          '">' +
          "</div>",
        focusConfirm: false,
        allowOutsideClick: false,
        showCancelButton: true,
        preConfirm: () => {
          return {
            id: pictureId,
            title: document.getElementById("swal-input1").value,
            imgLink: document.getElementById("swal-input2").value,
          };
        },
      });

      if (picture) {
        this.startLoading();
        await this.updatePicture(picture);
        this.updatedPictureId = picture.id;
        this.doneLoading();
        setTimeout(function () {
          this.updatedPictureId = -1;
        }, 2000);
      }
    },
    async showAlbumEditModal() {
      let title = this.album.title;
      let imgLink = this.album.coverImgLink;

      let { value: album } = await this.$swal({
        html:
          '<div class="form-group">' +
          '<input id="swal-input1" class="form-control" placeholder="Title" value="' +
          title +
          '">' +
          "</div>" +
          '<div class="">' +
          '<input id="swal-input2" class="form-control" placeholder="Cover image link" value="' +
          imgLink +
          '">' +
          "</div>",
        focusConfirm: false,
        allowOutsideClick: false,
        showCancelButton: true,
        preConfirm: () => {
          return {
            id: this.album.id,
            title: document.getElementById("swal-input1").value,
            coverImgLink: document.getElementById("swal-input2").value,
          };
        },
      });

      this.updateAlbum(album);
    },
    async deleteAlbum() {
      this.$swal({
        title: "Delete this album and all images below?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          this.destroyAlbum(this.album.id);
        }
      });
    },
    async addPicture() {
      let title = document.getElementById("picture-title").value;
      let imgLink = document.getElementById("picture-imgLink").value;

      if (title && imgLink) {
        const picture = {
          title,
          imgLink,
          orderNumber: this.album.pictures_count,
          album_id: this.album.id,
        };

        this.startLoading();
        await this.storePicture(picture);
        document.getElementById("picture-title").value = "";
        document.getElementById("picture-imgLink").value = "";
        this.updatedPictureId = picture.id;
        this.doneLoading();
        setTimeout(function () {
          this.updatedPictureId = -1;
        }, 2000);
      } else {
        toast("error", "Title and image link cannot be empty");
      }
    },
    async deletePicture(pictureId) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          this.destroyPicture(pictureId);
        }
      });
    },
    updateOrder(evt) {
      // if oldIndex === newIndex => do nothing
      if (evt.oldIndex !== evt.newIndex) {
        // passing object to store
        this.updateOrderNumber({
          id: this.album.id,
          oldIndex: evt.oldIndex,
          newIndex: evt.newIndex,
        });
      }
    },
  },
  computed: {
    ...mapGetters({
      album: "getAlbum",
      isLoading: "getIsLoadding",
    }),
  },
  created() {
    this.fetchAlbum(this.id);
  },
};
</script>

<style scoped>
.faded-in {
  animation-name: faded-in;
  animation-duration: 1.5s;
}

@keyframes faded-in {
  from {
    background-color: #eeeeee;
  }
  to {
    background-color: #fafafa;
  }
}

img {
  width: 100px;
  height: 100px;
  object-fit: cover;
}

tbody tr {
  cursor: move;
}
</style>
