import React from "react"
import PageWrap from "../components/PageWrap"

import styled from "styled-components"

import { graphql } from "gatsby"

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
      <PageWrap>
        <p>{birth}</p>
        <p>{lives}</p>
        <p>{about}</p>
        <Contact>
          <Text>Contact:</Text>
          <Text>{email}</Text>
        </Contact>
      </PageWrap>
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
  }
`

export default About
