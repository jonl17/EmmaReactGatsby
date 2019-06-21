import { GET_WORKS, SET_SCREEN_SIZE } from "./actions"

const initialState = {
  works: [],
  windowWidth: 0,
  device: `browser`,
}

export default (state = initialState, action) => {
  switch (action.type) {
    case GET_WORKS:
      return { ...state, works: action.works }
    case SET_SCREEN_SIZE:
      let device = ""
      if (action.width > 950) {
        device = `browser`
      }
      if (action.width < 950 && action.width > 600) {
        device = `tablet`
      }
      if (action.width < 600) {
        device = `mobileL`
      }
      if (action.width < 475) {
        device = `mobileS`
      }
      return { ...state, windowWidth: action.width, device: device }
    default:
      return state
  }
}
