import React from "react"
import { graphql, Link } from "gatsby"
import SliceZone from "../components/sliceZone"

const index = ({ data }) => {
  const { edges } = data.prismic.allHomepages
  return <SliceZone sliceZone={edges[0].node.body} />
}

export default index

export const query = graphql`
  {
    prismic {
      allHomepages {
        edges {
          node {
            body {
              __typename
              ... on PRISMIC_HomepageBodyImage_gallery {
                type
                label
                fields {
                  link_to_work {
                    ... on PRISMIC_Work {
                      _meta {
                        uid
                        type
                      }
                      title
                      frontpage_image
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
`
