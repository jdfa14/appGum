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
    NSMutableArray *_objects;
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
    self.navigationItem.leftBarButtonItem = self.editButtonItem;
    
    /*UIBarButtonItem *addButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(insertNewObject:)];
     self.navigationItem.rightBarButtonItem = addButton;*/
    NSMutableArray *musculo = [[NSMutableArray alloc] initWithObjects: @"Pecho", @"Bicep", @"Espalda", @"Hombro", @"Tricep", @"Trapecio", nil];
   // NSMutableArray *email = [[NSMutableArray alloc] initWithObjects:@"ivan@gmail.com", @"tania@gmail.com", @"aza@gmail.com", @"david@gmail.com", nil];
    
    _objects = [[NSMutableArray alloc] init];
    
    for (int i = 0; i< [musculo count]; i++){
        NSDictionary *miPerfil = [[NSDictionary alloc] initWithObjectsAndKeys:[musculo objectAtIndex:i], @"musculo", nil];
        //[email objectAtIndex:i], @"email", nil];
        [_objects addObject:miPerfil];
        
        [super viewDidLoad];
    }

    UIBarButtonItem *addButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(insertNewObject:)];
    self.navigationItem.rightBarButtonItem = addButton;
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (void)insertNewObject:(id)sender
{
    if (!_objects) {
        _objects = [[NSMutableArray alloc] init];
    }
    [_objects insertObject:[NSDate date] atIndex:0];
    NSIndexPath *indexPath = [NSIndexPath indexPathForRow:0 inSection:0];
    [self.tableView insertRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationAutomatic];
}

#pragma mark - Table View

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return _objects.count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    ILTMusculoTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"Cell" forIndexPath:indexPath];

    NSDictionary *object = _objects[indexPath.row];
    cell.musculoLabel.text = [object objectForKey:@"musculo"];
    
    
    /*cell.textLabel.text = @"\u2001 Wi-Fi 1";
    cell.detailTextLabel.text = @"\U0001F512 \u268A";
    
    cell.textLabel.text = @"\u2001 Wi-Fi 2";
    cell.detailTextLabel.text = @"\U0001F512 \u268C";
    
    cell.textLabel.text = @"\u2705 Wi-Fi 3";
    cell.detailTextLabel.text = @"\U0001F513 \u2630";*/
        
    return cell;
   
}

/*- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    UITableViewCell *cell = [tableView cellForRowAtIndexPath:indexPath];
    cell.accessoryType = UITableViewCellAccessoryCheckmark;
}*/

-(void)tableView:(UITableView *)tableView
accessoryButtonTappedForRowWithIndexPath:(NSIndexPath *)indexPath {
    
}


- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}

- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        [_objects removeObjectAtIndex:indexPath.row];
        [tableView deleteRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationFade];
    } else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view.
    }
}

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
        NSDate *object = _objects[indexPath.row];
        [[segue destinationViewController] setDetailItem:object];
    }
}

@end
