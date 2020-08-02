import React from "react"
import { NewsGrid } from "../components/Grid"
import Block from "../components/NewsBlock"

import { connect } from "react-redux"
import { graphql } from "gatsby"
import Img from "gatsby-image"

const News = ({ device }) => {
  const data = []
  return (
    <>
      <NewsGrid device={device}>
        {data.map((item, index) => (
          <Block key={index}>
            {item.ein_faersla.mynd === null ? (
              ""
            ) : (
              <Img
                fluid={item.ein_faersla.mynd.localFile.childImageSharp.fluid}
              ></Img>
            )}
          </Block>
        ))}
      </NewsGrid>
    </>
  )
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(News)
