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
