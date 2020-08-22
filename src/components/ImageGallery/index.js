import React from "react"
import { Grid } from "../Grid"
import { Link } from "gatsby"
import TextBox from "../FrontBoxText"
import "./styles.scss"

const ImageGallery = ({ slice }) => {
  return (
    <Grid>
      {slice.fields.map((field, idx) => {
        console.log(field)
        return (
          <Link
            className="position-relative d-flex justify-content-center workBox"
            to={`/work/${field.link_to_work._meta.uid}`}
            key={idx}
          >
            <img
              src={field.link_to_work.frontpage_image.url}
              alt={field.link_to_work.frontpage_image.alt}
            />
            <TextBox>{field.link_to_work.title[0].text}</TextBox>
          </Link>
        )
      })}
    </Grid>
  )
}

export default ImageGallery
