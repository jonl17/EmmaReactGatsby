import React from "react"
import { graphql, Link } from "gatsby"
import Wrap from "../components/Wrap"
import { Grid } from "../components/Grid"
import TextBox from "../components/FrontBoxText"
import Img from "gatsby-image"
import Header from "../components/Header"
import { GlobalStyles } from "../components/GlobalStyles"
import { connect } from "react-redux"
import { setCurrentWorkIndex } from "../state/actions"
import SEO from "../components/SEO"

const index = ({ data, device, dispatch }) => {
  return (
    <>
      <GlobalStyles></GlobalStyles>
      <SEO></SEO>
      <Header metadata={data.site.siteMetadata}></Header>
      <Wrap artworks={data.allWordpressWpWorks.edges}>
        <Grid device={device}>
          {data.allWordpressWpWorks.edges.map((item, index) => (
            <Link
              style={{
                position: "relative",
                display: "grid",
              }} /* doing this inline so titles stick inside boxes */
              key={index}
              to={"/" + item.node.slug}
              onClick={() => dispatch(setCurrentWorkIndex(index))}
            >
              <Img
                key={index}
                fluid={
                  item.node.acf.frontpage_image.localFile.childImageSharp.fluid
                }
              ></Img>
              <TextBox> {item.node.title.replace("#038;", "")}</TextBox>
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
