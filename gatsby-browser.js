import React from "react"
import { Provider } from "react-redux"
import { createStore as createEmmaStore } from "redux"
import rootReducer from "./src/state/index"
import { registerLinkResolver } from "gatsby-source-prismic-graphql"
import { linkResolver } from "./src/utils/linkResolver"

registerLinkResolver(linkResolver)

const createStore = () => createEmmaStore(rootReducer)

export const wrapRootElement = ({ element }) => {
  return <Provider store={createStore()}>{element}</Provider>
}
