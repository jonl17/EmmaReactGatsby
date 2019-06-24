import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"
import { Block, Title, Item } from "../components/CVblock"

import { GlobalStyles } from "../components/GlobalStyles.js"
import { graphql } from "gatsby"

const CV = ({ data }) => {
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Header metadata={data.site.siteMetadata}></Header>
      <Wrap>
        <PageWrap>
          <Block>
            <Title>Education BLA</Title>
            {data.wordpressPage.acf.education
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item key={index}>{item.one_education}</Item>
              ))}
          </Block>
          <Block>
            <Title>Upcoming Exhibitions</Title>
            {data.wordpressPage.acf.upcoming_exhibitions
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item upcoming key={index}>
                  {item.one_upcoming_exhibition}
                </Item>
              ))}
          </Block>
          <Block>
            <Title>Exhibitions</Title>
            {data.wordpressPage.acf.exhibitions
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item key={index}>{item.one_exhibition}</Item>
              ))}
          </Block>
          <Block>
            <Title>Other</Title>
            {data.wordpressPage.acf.other
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item key={index}>{item.one_other}</Item>
              ))}
          </Block>
        </PageWrap>
      </Wrap>
    </>
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
    wordpressPage(slug: { eq: "cv" }) {
      title
      acf {
        education {
          one_education
        }
        exhibitions {
          one_exhibition
        }
        other {
          one_other
        }
        upcoming_exhibitions {
          one_upcoming_exhibition
        }
      }
    }
  }
`

export default CV