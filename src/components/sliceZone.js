import React from "react"
import PageBodyText from "../components/PageBodyText"
import ImageGallery from "../components/ImageGallery"

const SliceZone = ({ sliceZone }) => {
  const sliceComponents = {
    text: PageBodyText,
    image_gallery: ImageGallery,
  }
  console.log(sliceZone)
  const sliceZoneContent = sliceZone.map((slice, index) => {
    const SliceComponent = sliceComponents[slice.type]
    if (SliceComponent) {
      console.log(slice)
      return <SliceComponent slice={slice} key={`slice-${index}`} />
    }
    return null
  })

  return <main id="slice-container">{sliceZoneContent}</main>
}

export default SliceZone
