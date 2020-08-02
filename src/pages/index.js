import React from "react"
import { graphql, Link } from "gatsby"
import { connect } from "react-redux"
import { setCurrentWorkIndex } from "../state/actions"

/** components */
import { Grid } from "../components/Grid"
import TextBox from "../components/FrontBoxText"
import Img from "gatsby-image"

const index = ({ data, device, dispatch }) => {
  if (true) {
    return <p>hello</p>
  } else {
    return (
      <>
        <Grid device={device}>
          {data.allWordpressWpWorks.edges.map((item, index) => (
            <Link
              style={{
                position: "relative",
                display: "grid",
              }} /* doing this inline so titles stick inside boxes */
              key={index}
              to={"/Works/" + item.node.slug}
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
      </>
    )
  }
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(index)
