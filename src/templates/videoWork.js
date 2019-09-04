import React from "react"
import { graphql } from "gatsby"
import Wrap from "../components/Wrap"
import { NewsGrid } from "../components/Grid"
import { connect } from "react-redux"
import { GlobalStyles } from "../components/GlobalStyles"
import VideoContainer from "../components/VideoWorksContainer"
import SEO from "../components/SEO"

const VideoWorkTemplate = ({ data: { wordpressWpWorks: works }, device }) => {
  return (
    <>
      <GlobalStyles />
      <SEO></SEO>
      <Wrap>
        <NewsGrid device={device}>
          <VideoContainer artwork={works}>
            <iframe
              src={works.acf.video}
              width="640"
              height="360"
              frameborder="0"
              allow="autoplay; fullscreen"
              allowfullscreen
            ></iframe>
          </VideoContainer>
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
        videowork
        video
      }
    }
  }
`

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(VideoWorkTemplate)
