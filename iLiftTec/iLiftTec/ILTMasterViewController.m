//
//  ILTMasterViewController.m
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTMasterViewController.h"

#import "ILTDetailViewController.h"
#import "ILTMusculoTableViewCell.h"

@interface ILTMasterViewController () {
    NSMutableArray *_definicion;
    NSMutableArray *_avance;
    NSArray *json;
   /* NSMutableArray *myObject;
    // A dictionary object
    NSDictionary *dictionary;
    // Define keys
    NSString *dia;
 */
}
@end

@implementation ILTMasterViewController

- (void)awakeFromNib
{
    [super awakeFromNib];
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    [self fetchReports];
    /*UIBarButtonItem *addButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(insertNewObject:)];
     self.navigationItem.rightBarButtonItem = addButton;*/
   NSMutableArray *musculo = [[NSMutableArray alloc] initWithObjects: @"Pecho", @"Bicep", @"Espalda", @"Hombro", @"Tricep", @"Trapecio", nil];
   // NSMutableArray *email = [[NSMutableArray alloc] initWithObjects:@"ivan@gmail.com", @"tania@gmail.com", @"aza@gmail.com", @"david@gmail.com", nil];
    
   /* _definicion =
    
    @[
     @[
      @{
          @"ejercicio" : @"Triceps",
          @"series" : @4,
          @"repeticiones" : @10
      },
      @{
          @"ejercicio" : @"Pierna",
          @"series" : @12,
          @"repeticiones" : @3
      }
      ],
     
     @[
         @{
             @"ejercicio" : @"Biceps",
             @"series" : @4,
             @"repeticiones" : @10
             },
         @{
             @"ejercicio" : @"Mancuernas",
             @"series" : @4,
             @"repeticiones" : @20
             }
         ],
     
     @[
         @{
             @"ejercicio" : @"Abdominales",
             @"series" : @3,
             @"repeticiones" : @50
             },
         @{
             @"ejercicio" : @"Fondos",
             @"series" : @12,
             @"repeticiones" : @3
             }
         ],
     
     @[
         @{
             @"ejercicio" : @"Bench Press",
             @"series" : @10,
             @"repeticiones" : @5
             },
         @{
             @"ejercicio" : @"Hombro",
             @"series" : @12,
             @"repeticiones" : @3
             }
         ],
     
     @[
         @{
             @"ejercicio" : @"Desplantes",
             @"series" : @10,
             @"repeticiones" : @5
             },
         @{
             @"ejercicio" : @"Trapecio",
             @"series" : @12,
             @"repeticiones" : @3
             }
         ],
     
     @[
         @{
             @"ejercicio" : @"Cristos",
             @"series" : @10,
             @"repeticiones" : @5
             },
         @{
             @"ejercicio" : @"Martillos",
             @"series" : @12,
             @"repeticiones" : @8
             }
         ],
     
     @[
         @{
             @"ejercicio" : @"Deadlifts",
             @"series" : @10,
             @"repeticiones" : @5
             },
         @{
             @"ejercicio" : @"Bench Press Inclinada",
             @"series" : @12,
             @"repeticiones" : @7
             }
         ]
     
     ];*/
    
    
    
    
    //[[NSMutableArray alloc] init];
    
    /*for (int i = 0; i< [musculo count]; i++){
        NSDictionary *miPerfil = [[NSDictionary alloc] initWithObjectsAndKeys:[musculo objectAtIndex:i], @"musculo", nil];
        //[email objectAtIndex:i], @"email", nil];
        [_definicion addObject:miPerfil];
        
        [super viewDidLoad];
    }*/

/*    dia = @"dias";
    
    myObject = [[NSMutableArray alloc] init];
    
    NSData *jsonSource = [NSData dataWithContentsOfURL:
                          [NSURL URLWithString:@"http://localhost/loans.js"]];
    
    id jsonObjects = [NSJSONSerialization JSONObjectWithData:
                      jsonSource options:NSJSONReadingMutableContainers error:nil];
    NSLog(@"%@", jsonObjects);

    for (id dataDict in jsonObjects) {
        
        NSLog(@"%@", dataDict);
        NSString *dia_data = [dataDict objectForKey:@"dia"];
        
        NSLog(@"DIA: %@",dia_data);
        
        dictionary = [NSDictionary dictionaryWithObjectsAndKeys:
                      dia_data, dia,
                      nil];
        [myObject addObject:dictionary];
    }*/

    /*UIBarButtonItem *addButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(insertNewObject:)];
    self.navigationItem.rightBarButtonItem = addButton;*/
}

- (void)fetchReports
{
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0), ^{
        
        NSUserDefaults *fetchDefaults = [NSUserDefaults standardUserDefaults];
        NSString *user = [fetchDefaults objectForKey:@"kUser"];
        
        NSLog(@"user %@", user);

        NSData* data =
        [NSData dataWithContentsOfURL:
         [NSURL URLWithString:[NSString stringWithFormat:@"http://localhost/get_rutina.php?matricula=%@", user]
          ]];
        
        NSError* error;
        NSDictionary *dict =
        [NSJSONSerialization JSONObjectWithData:data options:NSJSONReadingMutableContainers | NSJSONReadingAllowFragments error:&error];
        NSLog(@"%@", dict);
        _definicion = dict[@"dias"];
        NSLog(@"%@", _definicion);
        
        _avance = [[NSMutableArray alloc] init];
        for(NSArray *dia in _definicion) {
            NSMutableArray *avanceDia = [[NSMutableArray alloc] init];
            for(NSDictionary *ejercicio in dia) {
                [avanceDia addObject:[NSMutableDictionary dictionaryWithObjectsAndKeys:@NO, @"completado", @"", @"comentarios", nil]];
            }
            [_avance addObject:avanceDia];
        }
        
        dispatch_async(dispatch_get_main_queue(), ^{
            [self.tableView reloadData];
        });
    });
}
- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (void)insertNewObject:(id)sender
{
    if (!_definicion) {
        _definicion = [[NSMutableArray alloc] init];
    }
    [_definicion insertObject:[NSDate date] atIndex:0];
    NSIndexPath *indexPath = [NSIndexPath indexPathForRow:0 inSection:0];
    [self.tableView insertRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationAutomatic];
}

#pragma mark - Table View

-(NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    return [NSString stringWithFormat:@"Dia %d", (int)(section + 1)];
}

/*-(NSArray *)sectionIndexTitlesForTableView:(UITableView *)tableView {
    NSMutableArray *arr = [[NSMutableArray alloc] init];
    for(int i = 0; i < _definicion.count; i++) {
        [arr addObject:[NSString stringWithFormat:@"Dia %d", (int)(i + 1)]];
    }
    
    return arr;
}*/

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return _definicion.count;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return [_definicion[section] count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    ILTMusculoTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"Cell" forIndexPath:indexPath];
    /*if (cell == nil) {
        cell = [[ILTMusculoTableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:@"Cell"];
    }*/
   NSDictionary *object = _definicion[indexPath.section][indexPath.row];
    cell.musculoLabel.text = object[@"ejercicio"];
    cell.seriesL.text = [NSString stringWithFormat:@"%@", object[@"series"]];
    cell.repeticionesL.text = [NSString stringWithFormat:@"%@", object[@"repeticiones"]];
    
    cell.buttonIsOn = [_avance[indexPath.section][indexPath.row][@"completado"] boolValue];
    cell.section = indexPath.section;
    cell.row = indexPath.row;
    cell.papa = self;
    

    [cell updateImage];
   /* NSDictionary *tmpDict = [myObject objectAtIndex:indexPath.row];
    
    NSMutableString *text;
    //text = [NSString stringWithFormat:@"%@",[tmpDict objectForKey:title]];
    text = [NSMutableString stringWithFormat:@"%@",
            [tmpDict objectForKeyedSubscript:dia]];
    
    cell.musculoLabel.text = text;*/
    return cell;
   
}

-(void) updateDia: (NSInteger) dia ejercicio: (NSInteger) ejercicio completado: (BOOL) completado {
    _avance[dia][ejercicio][@"completado"] = [NSNumber numberWithBool:completado];
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    [tableView deselectRowAtIndexPath:indexPath animated:YES];
}

-(void)tableView:(UITableView *)tableView
accessoryButtonTappedForRowWithIndexPath:(NSIndexPath *)indexPath {
    
}


- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return NO;
}

/*- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        [_definicion removeObjectAtIndex:indexPath.row];
        [tableView deleteRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationFade];
    } else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view.
    }
}*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender
{
    if ([[segue identifier] isEqualToString:@"showDetail"]) {
        NSIndexPath *indexPath = [self.tableView indexPathForSelectedRow];
        [[segue destinationViewController] setAvance:_avance[indexPath.section][indexPath.row]];
    }
}

@end
