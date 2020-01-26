import React from "react"
import { Provider } from "react-redux"
import { createStore as createEmmaStore } from "redux"
import rootReducer from "./src/state/index"

const createStore = () => createEmmaStore(rootReducer)

export const wrapRootElement = ({ element }) => {
  return <Provider store={createStore()}>{element}</Provider>
}
