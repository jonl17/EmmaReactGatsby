import React from "react"
import { graphql, Link } from "gatsby"
import Wrap from "../components/Wrap"
import { Grid } from "../components/Grid"
import Img from "gatsby-image"
import Header from "../components/Header"
import { GlobalStyles } from "../components/GlobalStyles.js"
import { connect } from "react-redux"

const index = ({ data, device }) => {
  console.log(device)
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <Header metadata={data.site.siteMetadata}></Header>
      <Wrap artworks={data.allWordpressWpWorks.edges}>
        <Grid device={device}>
          {data.allWordpressWpWorks.edges.map((item, index) => (
            <Link key={index} to={"/" + item.node.slug}>
              <Img
                key={index}
                fluid={
                  item.node.acf.frontpage_image.localFile.childImageSharp.fluid
                }
              ></Img>
            </Link>
          ))}
        </Grid>
      </Wrap>
    </>
  )
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(index)

export const query = graphql`
  query {
    site {
      siteMetadata {
        title
        menuItems
      }
    }
    allWordpressWpWorks {
      edges {
        node {
          title
          slug
          featured_media {
            source_url
          }
          acf {
            frontpage_image {
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
