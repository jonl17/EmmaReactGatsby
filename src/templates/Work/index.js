import React from "react"
import { graphql, StaticQuery } from "gatsby"
import { RichText } from "prismic-reactjs"
import Link from "../../components/Link"

const PaginationWrap = ({ paginationNextUid }) => {
  return <Link to={paginationNextUid}>Next work</Link>
}

const Image = ({ src, caption }) => {
  return (
    <div>
      <img className="w-100" src={src} />
      <p className="pt-3 pb-5">{caption}</p>
    </div>
  )
}

const Work = ({ data, pageContext }) => {
  console.log(pageContext)
  if (!data) return null
  const { node } = data.prismic.allWorks.edges[0]
  return (
    <div className="container">
      <div className="d-flex justify-content-between my-4">
        <h3>{node.title[0].text}</h3>
        <h4>{node.year}</h4>
      </div>
      <div className="pb-5">{RichText.render(node.text)}</div>
      <div>
        {node.images.map((item, idx) => {
          return (
            <Image
              key={idx}
              src={item.image.url}
              caption={item.caption}
              alt=""
            />
          )
        })}
      </div>
      <PaginationWrap paginationNextUid={pageContext.paginationNextUid} />
    </div>
  )
}

export default Work

export const query = graphql`
  query workQuery($uid: String) {
    prismic {
      allWorks(uid: $uid) {
        edges {
          node {
            title
            text
            year
            frontpage_image
            images {
              image
              caption
            }
          }
        }
      }
    }
  }
`
