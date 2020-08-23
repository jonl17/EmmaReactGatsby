import React from "react"
import { graphql } from "gatsby"
import SliceZone from "../../components/sliceZone"

const Page = ({ data }) => {
  const prismicContent = data.prismic.allPages.edges[0]
  if (!prismicContent) {
    return null
  }
  const document = prismicContent.node

  return (
    <>
      <div className="container">
        <SliceZone sliceZone={document.body} />
      </div>
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
