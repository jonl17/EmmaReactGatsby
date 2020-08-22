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
    {
      resolve: "@prismicio/gatsby-source-prismic-graphql",
      options: {
        repositoryName: "emmaheidarsdottir",
        defaultLang: "is",
        accessToken: process.env.GATSBY_PRISMIC_ACCESS_TOKEN,
        sharpKeys: [/image|photo|picture/],
        pages: [
          {
            type: "Page",
            match: "/:uid",
            preview: "/page-preview",
            component: require.resolve("./src/templates/Page"),
            sortBy: "meta_lastPublicationDate_ASC",
          },
          {
            type: "Work",
            match: "/work/:uid",
            preview: "/work-preview",
            component: require.resolve("./src/templates/Work"),
            sortBy: "meta_lastPublicationDate_ASC",
          },
        ],
      },
    },
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    `gatsby-plugin-styled-components`,
    `gatsby-plugin-layout`,
    `gatsby-plugin-sass`,
    {
      resolve: `gatsby-plugin-google-analytics`,
      options: {
        trackingId: "UA-115486153-1",
      },
    },
  ],
}
