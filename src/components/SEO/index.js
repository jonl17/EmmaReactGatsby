import React from "react"
import { Helmet } from "react-helmet"
import { StaticQuery, graphql } from "gatsby"
import favicon from "../../../static/icon.png"

const SEO = () => (
  <StaticQuery
    query={graphql`
      query SEO {
        site {
          siteMetadata {
            title
            description
            url
          }
        }
      }
    `}
    render={data => (
      <>
        <Helmet title={data.site.siteMetadata.title}>
          <meta
            name="description"
            content={data.site.siteMetadata.description}
          ></meta>
          <meta name="image" content={favicon}></meta>
          {data.site.siteMetadata.title && (
            <meta property="og:title" content={data.site.siteMetadata.title} />
          )}
          {data.site.siteMetadata.description && (
            <meta
              property="og:description"
              content={data.site.siteMetadata.description}
            />
          )}
          {favicon && (
            <meta
              property="og:image"
              content={data.site.siteMetadata.favicon}
            />
          )}
          <link rel="shortcut icon" type="image/png" href={favicon}></link>
        </Helmet>
      </>
    )}
  ></StaticQuery>
)

export default SEO
