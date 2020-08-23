import React from "react"
import { StaticQuery, graphql } from "gatsby"
import Link from "../Link"
import "./styles.scss"

const navigationQuery = graphql`
  {
    prismic {
      allNavigations {
        edges {
          node {
            links {
              link {
                __typename
                ... on PRISMIC_Page {
                  _meta {
                    uid
                  }
                }
              }
              link_label
            }
          }
        }
      }
    }
  }
`

const Menu = ({ links }) => (
  <div className="d-flex">
    {links.map((item, idx) => {
      if (item.link.__typename === "PRISMIC_Homepage") {
        return (
          <Link
            className="linkItem"
            activeClassName="font-weight-bold text-dark"
            key={idx}
            to="/"
          >
            {item.link_label}
          </Link>
        )
      } else if (item.link._meta) {
        return (
          <Link
            className="linkItem"
            activeClassName="font-weight-bold text-dark"
            key={idx}
            to={`/${item.link._meta.uid}`}
          >
            {item.link_label}
          </Link>
        )
      } else return null
    })}
  </div>
)

const Navigation = ({ data }) => {
  const { links } = data.prismic.allNavigations.edges[0].node
  return (
    <div className="p-5">
      <Link to="/">
        <h3 className="mt-0 text-dark">Emma Heiðarsdóttir</h3>
      </Link>
      {links && <Menu links={links} />}
    </div>
  )
}

export default props => {
  return (
    <StaticQuery
      query={navigationQuery.toString()}
      render={data => <Navigation data={data} {...props} />}
    ></StaticQuery>
  )
}
