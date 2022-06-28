const { GraphQLObjectType, GraphQLInt, GraphQLString } = require('graphql');
const { dbQuery } = require('../database');
const Region = require('./Region.js');

const TerritoryType = new GraphQLObjectType({
    name: 'Territory',
    fields: () => (
        {
            TerritoryID: { type: GraphQLString },
            TerritoryDescription: { type: GraphQLString },
            RegionID: {
                type: Region,
                resolve: async (region) => {
                    let res = await dbQuery(`SELECT * FROM region WHERE RegionID = ${parseInt(region.RegionID)}`);
                    return res[0];
                }
            }
        }
    )
});

module.exports = TerritoryType;