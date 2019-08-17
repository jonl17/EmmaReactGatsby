import {
  GET_WORKS,
  SET_SCREEN_SIZE,
  SET_CURRENT_WORK,
  SET_CURRENT_WORK_INDEX,
} from "./actions"

const initialState = {
  works: [],
  currentWork: {} /* slug */,
  currentWorkIndex: 0,
  nextWork: {},
  nextWorkIndex: 0,
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
    default:
      return state
  }
}
