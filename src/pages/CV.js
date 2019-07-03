import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import PageWrap from "../components/PageWrap"
import { Block, Title, Item } from "../components/CVblock"
import SEO from "../components/SEO"

import { GlobalStyles } from "../components/GlobalStyles"
import { graphql } from "gatsby"

const CV = ({
  data: {
    site: { siteMetadata },
    wordpressPage: {
      acf: { education, upcoming_exhibitions, exhibitions, other },
    },
  },
}) => {
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <SEO></SEO>
      <Header metadata={siteMetadata}></Header>
      <Wrap>
        <PageWrap>
          <Block>
            <Title>Education</Title>
            {education
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item key={index}>{item.one_education}</Item>
              ))}
          </Block>
          <Block>
            <Title>Upcoming Exhibitions</Title>
            {upcoming_exhibitions
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
            {exhibitions
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item key={index}>{item.one_exhibition}</Item>
              ))}
          </Block>
          <Block>
            <Title>Other</Title>
            {other
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
