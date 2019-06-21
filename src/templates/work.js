import React from "react"
import { graphql } from "gatsby"
import Img from "gatsby-image"
import Wrap from "../components/Wrap"
import { NewsGrid } from "../components/Grid"
import { Block, Text } from "../components/NewsBlock"
import { connect } from "react-redux"
import { GlobalStyles } from "../components/GlobalStyles.js"

const WorkTemplate = ({ data, device }) => {
  console.log(data.wordpressWpWorks)
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Wrap>
        <h1>{data.wordpressWpWorks.title}</h1>
        <NewsGrid device={device}>
          <p>{data.wordpressWpWorks.acf.description}</p>
          {data.wordpressWpWorks.acf.myndir.map(item => (
            <Block>
              <Img
                fluid={item.mynd.myndaskra.localFile.childImageSharp.fluid}
              ></Img>
            </Block>
          ))}
        </NewsGrid>
      </Wrap>
    </>
  )
}

export const query = graphql`
  query($slug: String) {
    wordpressWpWorks(slug: { eq: $slug }) {
      title
      slug
      acf {
        description
        material
        year
        myndir {
          mynd {
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
