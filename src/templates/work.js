import React from "react"
import { graphql } from "gatsby"
import { useSelector, useDispatch } from "react-redux"
import { setPagenamePrefix } from "../state/actions"

/** components */
import Container from "../components/WorksContainer"
import { NewsGrid } from "../components/Grid"

const setPagePrefix = (prefix, dispatch) => {
  if (prefix.pagename !== undefined) {
    dispatch(setPagenamePrefix(prefix.pagename + " | "))
  }
}

const WorkTemplate = ({ pageContext, data: { wordpressWpWorks } }) => {
  const device = useSelector(state => state.reducer.device)
  const dispatch = useDispatch()
  setPagePrefix(pageContext, dispatch)
  return (
    <>
      <NewsGrid device={device}>
        <Container artwork={wordpressWpWorks} />
      </NewsGrid>
    </>
  )
}

export const query = graphql`
  query($slug: String) {
    wordpressWpWorks(slug: { eq: $slug }) {
      slug
      title
      acf {
        description
        material
        year
        videowork
        myndir {
          mynd {
            undirtexti
            texti
            myndaskra {
              localFile {
                childImageSharp {
                  fluid {
                    ...GatsbyImageSharpFluid
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

export default WorkTemplate
