import React from "react"
import { Helmet } from "react-helmet"
import { StaticQuery, graphql } from "gatsby"
import favicon from "../../../static/icon.png"
import { useSelector } from "react-redux"

const SEO = () => {
  const pagenamePrefix = useSelector(state => state.reducer.pagenamePrefix)
  return (
    <Helmet title='Emma Heiðarsdóttir'></Helmet>
    // <StaticQuery
    //   query={graphql`
    //     query SEO {
    //       site {
    //         siteMetadata {
    //           title
    //           description
    //           url
    //         }
    //       }
    //     }
    //   `}
    //   render={data => (
    //     <>
    //       <Helmet title={pagenamePrefix + " " + data.site.siteMetadata.title}>
    //         <meta
    //           name="description"
    //           content={data.site.siteMetadata.description}
    //         ></meta>
    //         <meta name="image" content={favicon}></meta>
    //         {pagenamePrefix + " " + data.site.siteMetadata.title && (
    //           <meta
    //             property="og:title"
    //             content={pagenamePrefix + " " + data.site.siteMetadata.title}
    //           />
    //         )}
    //         {data.site.siteMetadata.description && (
    //           <meta
    //             property="og:description"
    //             content={data.site.siteMetadata.description}
    //           />
    //         )}
    //         {favicon && (
    //           <meta
    //             property="og:image"
    //             content={data.site.siteMetadata.favicon}
    //           />
    //         )}
    //         <link rel="shortcut icon" type="image/png" href={favicon}></link>
    //       </Helmet>
    //     </>
    //   )}
    // ></StaticQuery>
  )
}

export default SEO
