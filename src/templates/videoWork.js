import React from "react"
import { graphql } from "gatsby"
import { useSelector, useDispatch } from "react-redux"
import { setPagenamePrefix } from "../state/actions"

/** components */
import VideoContainer from "../components/VideoWorksContainer"
import { NewsGrid } from "../components/Grid"

const setPagePrefix = (prefix, dispatch) => {
  if (prefix.pagename !== undefined) {
    dispatch(setPagenamePrefix(prefix.pagename + " | "))
  }
}

const VideoWorkTemplate = ({
  pageContext,
  data: { wordpressWpWorks: works },
}) => {
  const device = useSelector(state => state.reducer.device)
  const dispatch = useDispatch()
  setPagePrefix(pageContext, dispatch)
  return (
    <>
      <NewsGrid device={device}>
        <VideoContainer artwork={works}></VideoContainer>
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
        video
      }
    }
  }
`

export default VideoWorkTemplate
