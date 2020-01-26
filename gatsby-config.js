/**
 * Configure your Gatsby site with this file.
 *
 * See: https://www.gatsbyjs.org/docs/gatsby-config/
 */

module.exports = {
  siteMetadata: {
    title: `Emma Heiðarsdóttir`,
    description: `Emma Heiðarsdóttir is a visual artist from Reykjavík, Iceland.`,
    url: `https://www.emmaheidarsdottir.info`,
    favicon: `/static/icon.png`,
    menuItems: [
      { name: `Works`, slug: `/` },
      { name: `About`, slug: `/About` },
      { name: `CV`, slug: `/CV` },
      { name: `News`, slug: `/News` },
    ],
  },
  plugins: [
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    `gatsby-plugin-styled-components`,
    `gatsby-plugin-layout`,
    {
      resolve: "gatsby-source-wordpress",
      options: {
        baseUrl: "bakendi.emmaheidarsdottir.info/",
        protocol: "https",
        hostingWPCOM: false,
        useACF: true,
        includedRoutes: ["**/pages", "**/media", "**/works"],
        excludedRoutes: ["**/posts/1456"],
        normalizer: function({ entities }) {
          return entities
        },
      },
    },
    {
      resolve: `gatsby-plugin-google-analytics`,
      options: {
        trackingId: "UA-115486153-1",
      },
    },
  ],
}
