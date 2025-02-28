import axios from 'axios'

const API_URL = import.meta.env.VITE_API_URL || 'http://localhost/api'

const token = localStorage.getItem('token') || null

const apiClient = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`,
  },
})

apiClient.interceptors.request.use(
  (config) => {
    return config
  },
  (error) => Promise.reject(error)
)

export default {
  get(resource, config = {}) {
    return apiClient.get(resource, config)
  },
  post(resource, data, config = {}) {
    return apiClient.post(resource, data, config)
  },
  put(resource, data, config = {}) {
    return apiClient.put(resource, data, config)
  },
  delete(resource, config = {}) {
    return apiClient.delete(resource, config)
  },
  setHeader(header, value) {
    apiClient.defaults.headers.common[header] = value;
  },
}
