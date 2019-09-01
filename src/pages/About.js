import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"

import { GlobalStyles } from "../components/GlobalStyles"
import { graphql } from "gatsby"

import SEO from "../components/SEO"

const About = ({ data }) => {
  const { acf } = data.wordpressPage
  const { about, birth, lives } = acf
  return (
    <>
      <GlobalStyles />
      <SEO></SEO>
      <Header metadata={data.site.siteMetadata} />
      <Wrap>
        <PageWrap>
          <p>{birth}</p>
          <p>{lives}</p>
          <p>{about}</p>
        </PageWrap>
      </Wrap>
    </>
  )
}

export const query = graphql`
  query {
    wordpressPage(slug: { eq: "about" }) {
      title
      acf {
        about
        birth
        lives
      }
    }
    site {
      siteMetadata {
        title
        menuItems
      }
    }
  }
`

export default About
