import React from "react"
import { graphql } from "gatsby"
import SliceZone from "../../components/sliceZone"
import PageWrap from "../../components/PageWrap"
import Navigation from "../../components/Navigation"

const Page = ({ data }) => {
  const prismicContent = data.prismic.allPages.edges[0]
  if (!prismicContent) {
    return null
  }
  const document = prismicContent.node

  return (
    <>
      <PageWrap>
        <Navigation />
        <SliceZone sliceZone={document.body} />
      </PageWrap>
    </>
  )
}

export const query = graphql`
  query PageQuery($uid: String) {
    prismic {
      allPages(uid: $uid) {
        edges {
          node {
            _meta {
              uid
              type
            }
            body {
              __typename
              ... on PRISMIC_PageBodyText {
                type
                __typename
                primary {
                  text
                }
              }
            }
          }
        }
      }
    }
  }
`

export default Page
