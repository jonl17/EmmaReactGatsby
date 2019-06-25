import React from "react"
import { graphql } from "gatsby"
import Wrap from "../components/Wrap"
import { NewsGrid } from "../components/Grid"
import { connect } from "react-redux"
import { GlobalStyles } from "../components/GlobalStyles.js"
import Container from "../components/WorksContainer"
import SEO from "../components/SEO"

const WorkTemplate = ({ data, device }) => {
  return (
    <>
      <GlobalStyles />
      <SEO></SEO>
      <Wrap>
        <NewsGrid device={device}>
          <Container artwork={data.wordpressWpWorks} />
        </NewsGrid>
      </Wrap>
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

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(WorkTemplate)
