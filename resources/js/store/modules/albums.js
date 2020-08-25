import axios from 'axios';
import { toast } from '../../mixin';
import router from '../../router';

const state = {
  albums: [],
  album: {}
};

const getters = {
  getAllAlbums: state => state.albums,
  getAlbum: state => state.album
};

const actions = {
  async fetchAlbums({ commit }) {
    const response = await axios.get(`/api/albums`);

    if (response.status === 200) {
      toast('success', 'Albums loaded');
    }

    commit('setAlbums', response.data);
  },
  async fetchAlbum({ commit }, id) {
    const response = await axios.get(`/api/albums/${id}`);

    if (response.status === 200) {
      toast('success', 'Album loaded');
    }

    commit('setAlbum', response.data);
  },
  async storeAlbum({ commit }, album) {
    const response = await axios.post(`/api/albums`, album);

    if (response.status === 200) {
      toast('success', 'Album added');
    }

    commit('storeAlbum', response.data);
  },
  async updateAlbum({ commit }, album) {
    const response = await axios.put(`/api/albums/${album.id}`, album);

    if (response.status === 200) {
      toast('success', 'Album updated');
    }

    commit('updateAlbum', response.data);
  },
  // destruct object received from component
  async updateOrderNumber({ commit }, { id, oldIndex, newIndex }) {
    const response = await axios.put(`/api/albums/updatePicturesOrderNumber/${id}`, { oldIndex, newIndex });

    console.log(response);

    if (response.status === 200) {
      toast('success', 'Album updated');
    }

    commit('updateOrderNumber');
  },
  async destroyAlbum({ commit }, id) {
    const response = await axios.delete(`/api/albums/${id}`);

    if (response.status === 200) {
      toast('success', 'Album deleted');
    }

    commit('destroyAlbum');
  },
  async storePicture({ commit }, picture) {
    const response = await axios.post(`/api/pictures`, picture);

    if (response.status === 200) {
      toast('success', 'Picture added');
    }

    commit('storePicture', response.data);
  },
  async updatePicture({ commit }, picture) {
    const response = await axios.put(`/api/pictures/${picture.id}`, picture);

    if (response.status === 200) {
      toast('success', 'Picture updated');
    }

    commit('updatePicture', response.data);
  },
  async destroyPicture({ commit }, id) {
    const response = await axios.delete(`/api/pictures/${id}`);

    if (response.status === 200) {
      toast('success', 'Picture deleted');
    }

    commit('destroyPicture', id);
  }
};

const mutations = {
  setAlbums: (state, albums) => (state.albums = albums),
  setAlbum: (state, album) => (state.album = album),
  storeAlbum: (state, album) => {
    state.albums.push(album);
  },
  updateAlbum: (state, album) => {
    state.album.title = album.title;
    state.album.coverImgLink = album.coverImgLink;
  },
  updateOrderNumber: (state) => {
    console.log('OK');
  },
  destroyAlbum: () => {
    router.push({ path: '/' });
  },
  storePicture: (state, newPicture) => {
    state.album.pictures.push(newPicture);
    state.album.pictures_count++;
  },
  updatePicture: (state, newPicture) => {
    const index = state.album.pictures.findIndex(oldPicture => oldPicture.id === newPicture.id);

    if (index !== -1) {
      state.album.pictures.splice(index, 1, newPicture); // at position index, delete 1 item (old item), then add the new one
    }
  },
  destroyPicture: (state, id) => {
    state.album.pictures = state.album.pictures.filter(p => p.id !== id);
    state.album.pictures_count--;
  }
};

export default {
  state,
  getters,
  actions,
  mutations
};