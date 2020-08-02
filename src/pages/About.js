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

const About = () => {
  return (
    <>
      <PageWrap>
        <p>about page</p>
      </PageWrap>
    </>
  )
}

export default About
