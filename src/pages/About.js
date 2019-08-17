import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"

import { GlobalStyles } from "../components/GlobalStyles"
import { graphql } from "gatsby"
import Img from "gatsby-image"

import SEO from "../components/SEO"

const About = ({ data }) => {
  const { acf, featured_media } = data.wordpressPage
  const { about, birth, lives } = acf
  const { fluid } = featured_media.localFile.childImageSharp
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
          {featured_media === null ? "" : <Img fluid={fluid} />}
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
