import axios from 'axios';
import { toast } from '../../mixin';

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

    commit('setAlbums', response.data.data);
  },
  async fetchAlbum({ commit }, id) {
    const response = await axios.get(`/api/albums/${id}`);

    if (response.status === 200) {
      toast('success', 'Album loaded');
    }

    commit('setAlbum', response.data.data);
  },
  async storePicture({ commit }, picture) {
    const response = await axios.post(`/api/pictures`, picture);

    console.log(response);

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
  storePicture: (state, newPicture) => {
    state.album.pictures.push(newPicture);
  },
  updatePicture: (state, newPicture) => {
    const index = state.album.pictures.findIndex(oldPicture => oldPicture.id === newPicture.id);

    if (index !== -1) {
      state.album.pictures.splice(index, 1, newPicture); // at position index, delete 1 item (old item), then add the new one
    }
  },
  destroyPicture: (state, id) => {
    state.album.pictures = state.album.pictures.filter(p => p.id !== id);
  }
};

export default {
  state,
  getters,
  actions,
  mutations
};