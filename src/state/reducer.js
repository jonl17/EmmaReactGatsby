import {
  GET_WORKS,
  SET_DEVICE,
  SET_CURRENT_WORK,
  SET_CURRENT_WORK_INDEX,
  SET_PAGENAME_PREFIX,
} from "./actions"

const initialState = {
  works: [],
  currentWork: {} /* slug */,
  currentWorkIndex: 0,
  nextWork: {},
  nextWorkIndex: 0,
  windowWidth: 0,
  device: `browser`,
  pagenamePrefix: ``,
}

export default (state = initialState, action) => {
  switch (action.type) {
    case GET_WORKS:
      return { ...state, works: action.works }
    case SET_DEVICE:
      let device
      if (action.width <= 750) {
        device = `mobile`
      }
      if (action.width > 750 && action.width <= 1050) {
        device = `tablet`
      }
      if (action.width > 1050) {
        device = `browser`
      }
      return { ...state, device: device }
    case SET_CURRENT_WORK:
      return { ...state, currentWork: action.work }
    case SET_CURRENT_WORK_INDEX:
      if (action.index === state.works.length - 1) {
        return { ...state, currentWorkIndex: action.index, nextWorkIndex: 0 }
      } else {
        return {
          ...state,
          currentWorkIndex: action.index,
          nextWorkIndex: action.index + 1,
        }
      }
    case SET_PAGENAME_PREFIX:
      return { ...state, pagenamePrefix: action.prefix }
    default:
      return state
  }
}
