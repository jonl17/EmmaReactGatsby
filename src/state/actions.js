export const GET_WORKS = "GET_WORKS"
export const getWorks = works => ({
  type: GET_WORKS,
  works,
})

export const SET_DEVICE = "SET_DEVICE"
export const setDevice = width => ({
  type: SET_DEVICE,
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

export const SET_PAGENAME_PREFIX = "SET_PAGENAME_PREFIX"
export const setPagenamePrefix = prefix => ({
  type: SET_PAGENAME_PREFIX,
  prefix,
})
