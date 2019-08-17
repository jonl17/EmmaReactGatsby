import React from "react"
import { Provider } from "react-redux"
import { createStore as createEmmaStore } from "redux"
import rootReducer from "."

const createStore = () => createEmmaStore(rootReducer)

export default ({ element }) => (
  <Provider store={createStore()}>{element}</Provider>
)
