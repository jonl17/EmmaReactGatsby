import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"

import styled from "styled-components";

import { GlobalStyles } from "../components/GlobalStyles"
import { graphql } from "gatsby"

import SEO from "../components/SEO"

const Contact = styled.div`
  margin-top: 50px;
`
const Text = styled.p`
  margin: 0;
  color: black;
`

const About = ({ data }) => {
  const { acf } = data.wordpressPage
  const { about, birth, lives, email } = acf
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
          <Contact>
            <Text>Contact:</Text>
            <Text>{email}</Text>
          </Contact>
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
        email
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
