import React from "react"
import { GlobalStyles } from "../components/GlobalStyles/index.js"
import Wrap from "../components/Wrap"
import Header from "../components/Header"
import { graphql } from "gatsby"

export default ({ data }) => {
  return (
    <Wrap>
      <GlobalStyles></GlobalStyles>
      <Header metadata={data.site.siteMetadata}></Header>
      <div>
        <p>This page was not found... What are you doing !?!?!?</p>
      </div>
    </Wrap>
  )
}

export const query = graphql`
  query {
    site {
      siteMetadata {
        title
        menuItems
      }
    }
  }
`
