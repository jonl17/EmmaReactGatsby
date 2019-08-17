export const GET_WORKS = "GET_WORKS"
export const getWorks = works => ({
  type: GET_WORKS,
  works,
})

export const SET_SCREEN_SIZE = "SET_SCREEN_SIZE"
export const setScreenSize = width => ({
  type: SET_SCREEN_SIZE,
  width,
})

export const SET_CURRENT_WORK = "SET_CURRENT_WORK"
export const setCurrentWork = work => ({
  type: SET_CURRENT_WORK,
  work,
})

export const SET_CURRENT_WORK_INDEX = "SET_CURRENT_WORK_INDEX"
export const setCurrentWorkIndex = index => ({
  type: SET_CURRENT_WORK_INDEX,
  index,
})
