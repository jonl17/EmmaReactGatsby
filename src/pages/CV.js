import React from "react"
import PageWrap from "../components/PageWrap"
import { Block, Title, Item } from "../components/CVblock"

import { graphql } from "gatsby"

const CV = ({
  data: {
    wordpressPage: {
      acf: { education, exhibitions, other, upcoming_exhibitions },
    },
  },
}) => {
  return (
    <>
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
          {upcoming_exhibitions[0].one_upcoming_exhibition !== "null" ? (
            <Title>Upcoming Exhibitions</Title>
          ) : (
            <></>
          )}
          {upcoming_exhibitions[0].one_upcoming_exhibition !== "null" ? (
            upcoming_exhibitions
              .slice(0)
              .reverse()
              .map((item, index) => (
                <Item upcoming key={index}>
                  {item.one_upcoming_exhibition}
                </Item>
              ))
          ) : (
            <></>
          )}
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
    </>
  )
}

export const query = graphql`
  query {
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
