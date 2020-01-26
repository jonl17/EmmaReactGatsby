import React from "react"
import { NewsGrid } from "../components/Grid"
import Block from "../components/NewsBlock"

import { connect } from "react-redux"
import { graphql } from "gatsby"
import Img from "gatsby-image"

const News = ({ data, device }) => {
  return (
    <>
      <NewsGrid device={device}>
        {data.wordpressPage.acf.faersla
          .slice(0)
          .reverse()
          .map((item, index) => (
            <Block key={index}>
              {item.ein_faersla.mynd === null ? (
                ""
              ) : (
                <Img
                  fluid={item.ein_faersla.mynd.localFile.childImageSharp.fluid}
                ></Img>
              )}
              {/* {item.ein_faersla ? (
                  <Text href={item.ein_faersla.the_link.slod}>
                    {item.ein_faersla.the_link.texti}
                  </Text>
                ) : (
                  ""
                )} */}
            </Block>
          ))}
      </NewsGrid>
    </>
  )
}

export const query = graphql`
  query {
    wordpressPage(slug: { eq: "news" }) {
      title
      acf {
        faersla {
          ein_faersla {
            mynd {
              localFile {
                childImageSharp {
                  fluid {
                    ...GatsbyImageSharpFluid
                  }
                }
              }
            }
            link
            the_link {
              slod
              texti
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

export default connect(mapStateToProps)(News)
