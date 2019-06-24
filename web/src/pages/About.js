import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"

import { GlobalStyles } from "../components/GlobalStyles.js/index.js"
import { graphql } from "gatsby"
import Img from "gatsby-image"

const About = ({ data }) => {
  const { acf, featured_media } = data.wordpressPage
  const { about, birth, lives } = acf
  const { fluid } = featured_media.localFile.childImageSharp
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Header metadata={data.site.siteMetadata}></Header>
      <Wrap>
        <PageWrap>
          <p>{birth}</p>
          <p>{lives}</p>
          <p>{about}</p>
          <Img fluid={fluid}></Img>
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
      featured_media {
        localFile {
          childImageSharp {
            fluid {
              ...GatsbyImageSharpFluid
            }
          }
        }
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
