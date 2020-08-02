import React from "react"
import PageBodyText from "../components/PageBodyText"

const SliceZone = ({ sliceZone }) => {
  const sliceComponents = {
    text: PageBodyText,
  }

  const sliceZoneContent = sliceZone.map((slice, index) => {
    console.log(slice)
    const SliceComponent = sliceComponents[slice.type]
    if (SliceComponent) {
      return <SliceComponent slice={slice} key={`slice-${index}`} />
    }
    return null
  })

  return <main id='slice-container'>{sliceZoneContent}</main>
}

export default SliceZone
