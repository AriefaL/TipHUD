# TipHUD

This plugin is for [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) 3.x.x.
Which is where to access about server or player status

# ✍  Command List
| **Command** | **Description** | **Permission** |
| --- | --- |  --- |
| /tiphud on | Turn on TipHUD | No permission |
| /tiphud off | Turn off TipHUD | No permission |

# 📃  Configuration  
- Default configuration:

```yaml  
# Message Variables:
# {name}                    - Name of the player.
# {display_name}            - Display Name of the player.
# {health}                  - Health of the player.
# {max_health}              - Max Health of the player.
# {money}                   - Money of the player. (Requires EconomyAPI by poggit-orphanage).
# {online}                  - The number of online players.
# {max_online}              - Max number of players allowed on the server.
# {rank}                    - Players current in-game rank/group. (Requires PurePerms by poggit-orphanage).
# {item_name}               - Name of the item in players hand.
# {item_id}                 - ID of the item in players hand.
# {item_meta}               - Meta/Damage of the item in players hand.
# {item_count}              - Amount of item in the players hand.
# {x}/{y}/{z}               - X/Y/Z coordinate of the player.
# {faction}                 - Faction of the player. (Requires FactionsPro by poggit-orphanage).
# {faction_power}           - Power of the faction. (Requires FactionsPro by poggit-orphanage).
# {load}                    - Current load on the server (0 - 100%)
# {tps}                     - TPS of the server.
# {level_name}              - Name of the players current level/world.
# {level_folder_name}       - Folder name of the players current level/world.
# {ip}                      - IP of the player.
# {ping}                    - Ping of the player.
# {time}                    - Show the current time.
# {h}/{i}/{s}               - Hours/Minutes/Seconds.
# {date}                    - Show the current date.
# {d}/{m}/{y}               - Day/Month/Years.
# {random_color}            - Add color random.
# &                         - Add colors.
# Format
format: "&6Name: &f{name} &6|| Online: &f{online}"
```
