import React from "react"
import Header from "../components/Header"
import Wrap from "../components/Wrap"
import { NewsGrid } from "../components/Grid"
import Block from "../components/NewsBlock"
import { Text } from "../components/Text"

import { connect } from "react-redux"
import { GlobalStyles } from "../components/GlobalStyles.js/index.js"
import { graphql } from "gatsby"
import Img from "gatsby-image"

const News = ({ data, device }) => {
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Header metadata={data.site.siteMetadata}></Header>
      <Wrap>
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
                    fluid={
                      item.ein_faersla.mynd.localFile.childImageSharp.fluid
                    }
                  ></Img>
                )}
                {item.ein_faersla ? (
                  <Text href={item.ein_faersla.the_link.slod}>
                    {item.ein_faersla.the_link.texti}
                  </Text>
                ) : (
                  ""
                )}
              </Block>
            ))}
        </NewsGrid>
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
