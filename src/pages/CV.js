import React from "react"
import PageWrap from "../components/PageWrap"
import { Block, Title, Item } from "../components/CVblock"

import { graphql } from "gatsby"

const CV = () => {
  const education = []
  const upcoming_exhibitions = []
  const exhibitions = []
  const other = []
  return (
    <>
      <PageWrap>
        <Block>
          <Title>Education</Title>
          {education.map((item, index) => (
            <Item key={index}>{item.one_education}</Item>
          ))}
        </Block>
        <Block>
          {upcoming_exhibitions.map((item, index) => (
            <Item upcoming key={index}>
              {item.one_upcoming_exhibition}
            </Item>
          ))}
        </Block>
        <Block>
          <Title>Exhibitions</Title>
          {exhibitions.map((item, index) => (
            <Item key={index}>{item.one_exhibition}</Item>
          ))}
        </Block>
        <Block>
          <Title>Other</Title>
          {other.map((item, index) => (
            <Item key={index}>{item.one_other}</Item>
          ))}
        </Block>
      </PageWrap>
    </>
  )
}

export default CV
